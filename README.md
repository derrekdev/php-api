# php-api

**POST** _/message_

An endpoint that accepts JSON request data with **conversation_id** and **message** properties.

The response should be JSON data with **response_id** being the same as the request’s
**conversation_id**, and the **response** would be based on the context table matching the
message.

**Context Table:**

If the message contains a word from the context table, return the corresponding response.
First context detected takes priority.
<table>
  <tr>
    <td>[Hello, Hi]</td>
    <td>Welcome to StationFive.</td>
  </tr>
  <tr>
    <td>[Goodbye, bye]</td>
    <td>Thank you, see you around.</td>
  </tr>
  <tr>
    <td>No Context</td>
    <td>No Context Sorry, I don’t understand.</td>
  </tr>
  
</table>
  



Example Request:

    {
      conversation_id: 'abcd123',
      message: 'Hello, I’m John',
    }

Example Response:

    {
      response_id: 'abcd123',
      response: 'Welcome to StationFive.',
    }

Note: Should return an error if the request data is not in the proper format.
