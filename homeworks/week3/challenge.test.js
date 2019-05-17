const times = require('./challenge');

describe('challenge', () => {
  it('should return correct answer when a=278 and b=14', () => {
    expect(times('278', '14')).toEqual('3892');
  });
  it('should return correct answer when a=2456 and b=1', () => {
    expect(times('2456', '1')).toEqual('2456');
  });
  it('should return correct answer when a=47896 and b=523', () => {
    expect(times('47896', '523')).toEqual('25049608');
  });
});
