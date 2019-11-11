import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ChemicalViewComponent } from './chemical-view.component';

describe('ChemicalViewComponent', () => {
  let component: ChemicalViewComponent;
  let fixture: ComponentFixture<ChemicalViewComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ChemicalViewComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ChemicalViewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
