# VerticalResponse API Wrapper

[![Latest Stable Version](https://poser.pugx.org/navarr/verticalresponse/v/stable)](https://packagist.org/packages/navarr/verticalresponse)
[![License](https://poser.pugx.org/navarr/verticalresponse/license)](https://packagist.org/packages/navarr/verticalresponse)
[![Scrutinizer](https://scrutinizer-ci.com/g/navarr/verticalresponse/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/navarr/verticalresponse/)
[![Total Downloads](https://poser.pugx.org/navarr/verticalresponse/downloads)](https://packagist.org/packages/navarr/verticalresponse)

## Introduction

Everyone loves an API Wrapper!  This one wraps the VerticalResponse API (v1).

VerticalResponse's own wrapper was pretty good - but in a PHP folder, with no composer support, strange class names, and 
everything else - I figured it was time to update it!

## How to Use

### Installation

Because I'm crazy, I tried to keep this library from having any opinions on what library to use for sending HTTP
requests.  That's neat, because it means you can throw in your own HTTP client if you want to.

On that note, however, I also made it default to using Guzzle if you didn't specify one - so that you could keep the
constructor as clean as possible.

HOWEVER, I didn't want all of Guzzle packaged with every installation of this - so it's only a _suggested_ dependency.

TL;DR: To use this library, it's recommended you `composer require navarr/verticalresponse navarr/verticalresponse-guzzle`.

### Usage in Code

You will first have to get an Authorization Token from the VerticalResponse OAuth 2.0 API Endpoint.  This is left as an
exercise to the reader.

Once you've done that, just pipe it in to the VerticalResponse Client, like so:

    $vr = new \VerticalResponse\Client($authorizationToken);
    $response = $vr->get('lists');
    var_dump($response);

For a new VerticalResponse account, the output would look something like this:

    class stdClass#35 (3) {
      public $url =>
      string(47) "https://vrapi.verticalresponse.com/api/v1/lists"
      public $items =>
      array(1) {
        [0] =>
        class stdClass#29 (2) {
          public $url =>
          string(62) "https://vrapi.verticalresponse.com/api/v1/lists/25288767452069"
          public $attributes =>
          class stdClass#22 (4) {
            ...
          }
        }
      }
      public $links =>
      class stdClass#33 (1) {
        public $up =>
        class stdClass#36 (1) {
          public $url =>
          string(41) "https://vrapi.verticalresponse.com/api/v1"
        }
      }
    }
    
The current version of this library does not provide any sort of ActiveRecord utilities for managing the data from this
API.  That, too, is left as an exercise to the reader.
