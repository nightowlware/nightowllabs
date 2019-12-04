import {
  SubscribeMessage,
  WebSocketGateway,
  WebSocketServer
} from '@nestjs/websockets';
import { Socket, Server } from 'socket.io';

// For more on namespaced socket.io, see here:
// https://socket.io/docs/rooms-and-namespaces/
@WebSocketGateway({ namespace: 'public' })
export class WebsocketGateway {
  // The underlying websocket server
  @WebSocketServer()
  server: Server;

  @SubscribeMessage('message')
  handleMessage(client: Socket, payload: any): string {
    // console.log('Received payload from WS client: ' + JSON.stringify(payload));

    // Echo back whatever payload was sent
    client.send(payload);

    return 'ACK';
  }
}
