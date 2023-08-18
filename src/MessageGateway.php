<?php

class MessageGateway {
  private $responseData = [
    [
      'response_text' => ['Hello','Hi'],
      'response_message' => 'Welcome to StationFive.'
    ],
    [
      'response_text' => ['Goodbye','bye'],
      'response_message' => 'Thank you, see you around'
    ]
  ];
  private $noContext = "Sorry, I don’t understand.";
  private $invalidData = ['message' => 'Invalid json'];

  public function getInvalidResponse() {
    return $this->invalidData;
  }

  public function getResponse(string $message): array | string {
    $separators = [',', " "];
    $words = [];
    $responseMessage = "";

    foreach($separators as $separator) {
      $words = array_merge(explode($separator, $message),$words);

    }

    foreach($this->responseData as $responseData){
      foreach($responseData['response_text'] as $responseText){
        if (in_array($responseText,$words)){
          $responseMessage = $responseData['response_message'];
          break;
        };
      }
    }
   
    return $responseMessage != "" ? $responseMessage : $this->noContext;
  }

}