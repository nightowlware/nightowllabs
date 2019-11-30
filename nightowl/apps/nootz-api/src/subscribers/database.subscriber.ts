import {
  EventSubscriber,
  EntitySubscriberInterface,
  InsertEvent
} from 'typeorm';

@EventSubscriber()
export class DatabaseSubscriber implements EntitySubscriberInterface {
  beforeInsert(event: InsertEvent<any>) {}

  afterInsert(event: InsertEvent<any>) {
    const e = event.entity;
    const manager = event.manager;
    e.json.triggerInserted = true;
    manager.save(e);
  }
}
