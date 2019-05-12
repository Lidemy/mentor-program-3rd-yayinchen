const add = require('./hw5');

describe('hw5', () => {
  it('should return correct answer when a=99 and b=1', () => {
    expect(add('99', '1')).toBe('100');
  });
  it('should return correct answer when a=789 and b=1111', () => {
    expect(add('789', '1111')).toBe('1900');
  });
});
