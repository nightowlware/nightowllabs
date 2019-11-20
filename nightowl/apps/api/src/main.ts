import { NestFactory } from '@nestjs/core';
import { AppModule } from './app/app.module';
import * as dotenv from 'dotenv';

// Enable configuration-by-env file: key-value pairs
// are injected into the "process.env" object.
// Note that a reboot is required every time the .env values
// change.
dotenv.config();

async function bootstrap() {
  const app = await NestFactory.create(AppModule);
  const globalPrefix = 'api';
  app.setGlobalPrefix(globalPrefix);

  // Should read from local .env file
  const port = process.env.API_PORT || 6666;

  await app.listen(port, () => {
    console.log('Listening at http://localhost:' + port + '/' + globalPrefix);
  });
}

bootstrap();
