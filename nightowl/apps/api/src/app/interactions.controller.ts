import {
  Get,
  Controller,
  Logger,
  HttpException,
  HttpStatus
} from '@nestjs/common';
import { AppService } from './app.service';

@Controller('interactions')
export class InteractionsController {
  constructor(private readonly service: AppService) {}

  @Get('/')
  getInteractions() {
    return this.service.getAllInteractions();
  }

  @Get('/save')
  saveInteraction() {
    return this.service.saveInteraction();
  }
}
