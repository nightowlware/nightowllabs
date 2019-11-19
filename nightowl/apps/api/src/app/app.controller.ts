import {
  Controller,
  Get,
  UseInterceptors,
  CacheInterceptor,
  HttpException,
  HttpStatus,
  Logger
} from '@nestjs/common';

import { AppService } from './app.service';

@Controller()
@UseInterceptors(CacheInterceptor)
export class AppController {
  constructor(private readonly appService: AppService) {}

  @Get()
  getData() {
    return this.appService.getData();
  }
}
