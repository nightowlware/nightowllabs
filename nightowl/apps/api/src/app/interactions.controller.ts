import {
  Get,
  Controller,
  Logger,
  HttpException,
  HttpStatus
} from '@nestjs/common';
import { Crud } from '@nestjsx/crud';
import { AppService } from './app.service';
import { Interaction } from '../entities/interaction.entity';

@Crud({
  model: {
    type: Interaction
  },

  params: {
    id: {
      field: 'id',
      type: 'uuid',
      primary: true
    }
  }
})
@Controller('interactions')
export class InteractionsController {
  constructor(private readonly service: AppService) {}

  // @Get('/')
  // getInteractions() {
  //   return this.service.getAllInteractions();
  // }

  // @Get('/save')
  // saveInteraction() {
  //   return this.service.saveInteraction();
  // }
}
