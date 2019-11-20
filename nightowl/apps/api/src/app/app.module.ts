import { Logger, CacheModule, Module, HttpModule } from '@nestjs/common';
import { TypeOrmModule } from '@nestjs/typeorm';
import { environment } from '../environments/environment';

import { AppController } from './app.controller';
import { AppService } from './app.service';
import { Connection } from 'typeorm';

@Module({
  imports: [
    HttpModule,
    CacheModule.register({ ttl: 5, max: 100 }),
    TypeOrmModule.forRoot({
      type: 'mongodb',
      host: process.env.MONGO_HOST || 'localhost',
      port: Number(process.env.MONGO_PORT) || 27017,
      username: process.env.MONGO_USERNAME || 'nootz',
      password: process.env.MONGO_PASSWORD || 'nootz',
      database: 'nootz',
      entities: [],
      synchronize: !environment.production,
      useUnifiedTopology: true
    })
  ],
  controllers: [AppController],
  providers: [AppService]
})
export class AppModule {
  constructor(private readonly connection: Connection) {
    const { password, ...others } = connection.options as any;
    Logger.log(`DB connection info: ${JSON.stringify(others)}`);
  }
}
