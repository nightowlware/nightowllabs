import { Logger, CacheModule, Module, HttpModule } from '@nestjs/common';
import { TypeOrmModule } from '@nestjs/typeorm';
import { environment } from '../environments/environment';

import { AppController } from './app.controller';
import { AppService } from './app.service';
import { Connection } from 'typeorm';
import { Interaction } from '../entities/interaction.entity';
import { DatabaseSubscriber } from '../subscribers/database.subscriber';
import { InteractionsController } from './interactions.controller';
import { WebsocketGateway } from '../websocket.gateway';

// Unfortunately due to Webpack out-of-order execution, this import
// needs to be repeated here so that the @Module decorator below can
// see the .env file correctly.
import * as dotenv from 'dotenv';
dotenv.config();

@Module({
  imports: [
    HttpModule,
    CacheModule.register({ ttl: 5, max: 100 }),
    TypeOrmModule.forRoot({
      type: 'postgres',
      host: process.env.DB_HOST || 'localhost',
      port: Number(process.env.DB_PORT) || 5432,
      username: process.env.DB_USERNAME || 'nootz',
      password: process.env.DB_PASSWORD || 'nootz',
      database: 'nootz',
      entities: [Interaction],
      subscribers: [DatabaseSubscriber],
      // synchronize: !environment.production
      synchronize: true
    }),
    TypeOrmModule.forFeature([Interaction])
  ],
  controllers: [AppController, InteractionsController],
  providers: [AppService, WebsocketGateway]
})
export class AppModule {
  constructor(private readonly connection: Connection) {
    const { password, ...others } = this.connection.options as any;
    Logger.log(`DB connection info: ${JSON.stringify(others)}`);
  }
}
