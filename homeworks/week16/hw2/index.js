class Stack {
  constructor() {
    this.array = [];
  }

  push(item) {
    this.array[this.array.length] = item;
  }

  pop() {
    const output = this.array[this.array.length - 1];
    this.array.splice(this.array.length - 1, 1);
    return output;
  }
}

class Queue {
  constructor() {
    this.array = [];
  }

  push(item) {
    this.array[this.array.length] = item;
  }

  pop() {
    const output = this.array[0];
    this.array.splice(0, 1);
    return output;
  }
}

const stack = new Stack();
stack.push(10);
stack.push(5);
console.log(stack.pop()); // 5
console.log(stack.pop()); // 10

const queue = new Queue();
queue.push(1);
queue.push(2);
console.log(queue.pop()); // 1
console.log(queue.pop()); // 2
