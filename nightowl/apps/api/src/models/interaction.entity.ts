import { Entity, Column } from 'typeorm';
import { BaseEntity } from './base.entity';

@Entity({ name: 'interaction' })
export class Interaction extends BaseEntity {
  @Column({ type: 'varchar', length: 300 })
  chemical: string;

  @Column({ type: 'varchar', length: 300 })
  details: string;
}
