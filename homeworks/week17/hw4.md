``` js
const obj = {
  value: 1,
  hello: function() {
    console.log(this.value)
  },
  inner: {
    value: 2,
    hello: function() {
      console.log(this.value)
    }
  }
}
  
const obj2 = obj.inner
const hello = obj.inner.hello
obj.inner.hello() // 2
obj2.hello() // 2
hello() // undefined
```

1) obj.inner.hello() => obj.inner.hello.call(obj.inner) obj.inner 的 value: 2 ，輸出 2
2) obj2.hello() => obj2.hello.call(obj2) obj2 == obj.inner 其 value: 2 ，輸出 2
3) hello() => hello.call(undefined) 嚴格模式為 undefined ， node 環境為 global ，瀏覽器環境為 window