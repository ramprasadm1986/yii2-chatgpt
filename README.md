# Yii2 ChatGPT Component

A Yii2 component to interact with the OpenAI ChatGPT API.

## Installation

Install via Composer:

```shell
composer require ramprasadm1986/yii2-chatgpt

## ChatGPT


Configure `chatGPT` in `config/web.php`:

```php
'components' => [
    'chatGPT' => [
        'class' => 'ramprasadm1986\chatgpt\ChatGPT',
        'apiKey' => 'YOUR_OPENAI_API_KEY',
    ],
],

### Usage Example

```php
$response = $response = Yii::$app->chatgpt->askGPT('What is the weather like today?', 'general knowledge', 'gpt-3.5-turbo');
echo $response;

## AgriAdvisorGPT

In addition to standard ChatGPT interactions, this package provides `AgriAdvisorGPT` for agriculture-specific questions. It uses a custom system prompt to provide specialized advice.


Configure `AgriAdvisorGPT` in `config/web.php`:

```php
'components' => [
    'agriAdvisorGPT' => [
        'class' => 'ramprasadm1986\chatgpt\AgriAdvisorGPT',
        'apiKey' => 'YOUR_OPENAI_API_KEY',
    ],
],

### Usage in Yii2 Project

You can now use the `agriAdvisorGPT` component to get tailored advice for agricultural topics. Examples:

**General Advice**:

```php
$response = Yii::$app->agriAdvisorGPT->askAgriAdvisor('What are the best practices for pest management in organic farming?');
echo $response;

$response = Yii::$app->agriAdvisorGPT->askCropAdvisor('corn', 'How often should I irrigate corn during summer?');
echo $response;
