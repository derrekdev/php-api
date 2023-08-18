<?php

class MessageController {
  public function __construct(private MessageGateway $gateway) {}

  public function processRequest(string $method, array $post): void {
    $conversationId = isset($post['conversation_id']) ? $post['conversation_id'] : '';
    $message = isset($post['message']) ? $post['message'] : '';

    if (!!$conversationId && !!$message) {
      $this->processMessageRequest($method, $conversationId, $message);
    } else {
      $this->processInvalidRequest();
    }
  }

  private function processInvalidRequest(): void {
    echo json_encode($this->gateway->getInvalidResponse());
  }

  private function processMessageRequest(string $method, string $conversationId, string $message): void {
    switch ($method) {
      case "POST":
        $message = $this->gateway->getResponse($message);
        $responseJson = [
          'response_id' => $conversationId,
          'response' => $message
        ];
        http_response_code(201);
        echo json_encode($responseJson);
        break;
      
      default:
        http_response_code(404);
        $this->processInvalidRequest();
        break;
    }
  }
}