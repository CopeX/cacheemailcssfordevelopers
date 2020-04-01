# Mage2 Module CopeX CacheEmailCssForDevelopers

## Summary
Speeds Up Magento 2 Email Sending by caching the css-content of the files !!ONLY FOR DEVELOPERS!!

## Main Functionalities
This module caches the getCssFilesContent function in Magento\Email\Model\Template\Filter

In development environments the pub/static email.css file is not generated thus it tries to generate it every time an email is sent,
the problem is that the css file is generated by a lot of different modules and takes very long to be processed

The cache tag for the cache is "config", so everytime you clear the cache the first email that is sent takes a long time to be processed


## How does it work

As we all know it is not a good idea to use an around plugin but in this case it was the best approach.
We added an around plugin Magento\Email\Model\Template\Filter::getCssFilesContent that caches the output of the main function in the cache

## Installation
Use composer