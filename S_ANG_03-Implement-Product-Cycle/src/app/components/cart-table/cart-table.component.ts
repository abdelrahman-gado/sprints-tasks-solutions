import { Component, EventEmitter, Input, Output } from '@angular/core';
import { CartLine } from 'src/app/interfaces/cart-line';

@Component({
  selector: 'app-cart-table',
  templateUrl: './cart-table.component.html',
  styleUrls: ['./cart-table.component.css'],
})
export class CartTableComponent {
  @Input() cartLines: CartLine[] = [];
  @Output() limitAlert = new EventEmitter<string>();

  decQuantity(i: number): void {
    if (this.cartLines[i].quantity > 1) this.cartLines[i].quantity -= 1;

    if (this.cartLines[i].quantity < 2) {
      this.limitAlert.emit('Please increase your value');
    }
  }

  incQuantity(i: number): void {
    this.cartLines[i].quantity += 1;
    if (this.cartLines[i].quantity > 10) {
      // send to the parent cmponent that you passed the limit.
      this.limitAlert.emit('You have exceeded the limit');
    }
  }

  remove(i: number): void {
    this.cartLines.splice(i, 1);
  }
}
