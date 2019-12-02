import {
  SubscribeMessage,
  WebSocketGateway,
  WebSocketServer
} from '@nestjs/websockets';
import { Socket, Server } from 'socket.io';

// For more on namespaced socket.io, see here:
// https://socket.io/docs/rooms-and-namespaces/
@WebSocketGateway({ namespace: '/' })
export class WebsocketGateway {
  // The underlying websocket server
  @WebSocketServer()
  server: Server;

  @SubscribeMessage('message')
  handleMessage(client: Socket, payload: any): string {
    console.log('Received payload from WS client: ' + JSON.stringify(payload));
    return 'ACK';
  }
}
