import { CacheModule, Module, HttpModule } from '@nestjs/common';

import { AppController } from './app.controller';
import { AppService } from './app.service';

@Module({
  imports: [
    HttpModule,
    CacheModule.register({
      ttl: 5,
      max: 100
    })
  ],
  controllers: [AppController],
  providers: [AppService]
})
export class AppModule {}
