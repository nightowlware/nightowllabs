import {
  Controller,
  Get,
  UseInterceptors,
  CacheInterceptor
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
