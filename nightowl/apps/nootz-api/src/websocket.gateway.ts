import {
  SubscribeMessage,
  WebSocketGateway,
  WebSocketServer,
  OnGatewayDisconnect,
  OnGatewayConnection,
  OnGatewayInit
} from '@nestjs/websockets';
import { Socket, Server } from 'socket.io';

// For more on namespaced socket.io, see here:
// https://socket.io/docs/rooms-and-namespaces/
@WebSocketGateway({ namespace: 'public' })
export class WebsocketGateway
  implements OnGatewayConnection, OnGatewayDisconnect, OnGatewayInit {
  // The underlying websocket server
  @WebSocketServer()
  server: Server;

  private connectedClients: Socket[];

  constructor() {
    this.connectedClients = [];
  }

  handleConnection(client: Socket, ...args: any[]) {
    this.connectedClients.push(client);
    console.log('Websocket client connected');
  }

  handleDisconnect(client: Socket) {
    this.connectedClients = this.connectedClients.filter(
      item => item !== client
    );
    console.log('Websocket client disconnected');
  }

  afterInit(server: any) {
    if (this.server !== server) {
      throw new Error(
        'Something went wrong initializing the Websocket Gateway'
      );
    }
  }

  @SubscribeMessage('message')
  handleMessage(client: Socket, payload: any): string {
    // console.log('Received payload from WS client: ' + JSON.stringify(payload));

    // Echo back whatever payload was sent
    client.send(payload);

    return 'ACK';
  }
}
