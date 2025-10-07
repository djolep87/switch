// Custom functions for Artillery load testing

module.exports = {
  // Generate random string for testing
  randomString: function () {
    const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    let result = '';
    const length = Math.floor(Math.random() * 10) + 5; // 5-15 characters
    for (let i = 0; i < length; i++) {
      result += chars.charAt(Math.floor(Math.random() * chars.length));
    }
    return result;
  },

  // Pick random item from array
  pick: function (array) {
    return array[Math.floor(Math.random() * array.length)];
  },

  // Generate random email
  randomEmail: function () {
    const domains = ['gmail.com', 'yahoo.com', 'hotmail.com', 'test.com'];
    const username = this.randomString();
    const domain = this.pick(domains);
    return `${username}@${domain}`;
  },

  // Generate random phone number
  randomPhone: function () {
    return '+381' + Math.floor(Math.random() * 9000000000) + 1000000000;
  },

  // Generate random product name
  randomProductName: function () {
    const adjectives = ['Amazing', 'Great', 'Perfect', 'Excellent', 'Super', 'Fantastic'];
    const nouns = ['Product', 'Item', 'Good', 'Thing', 'Device', 'Tool'];
    const adjective = this.pick(adjectives);
    const noun = this.pick(nouns);
    return `${adjective} ${noun} ${Math.floor(Math.random() * 1000)}`;
  },

  // Generate random description
  randomDescription: function () {
    const descriptions = [
      'This is a great product in excellent condition.',
      'Perfect item for everyday use.',
      'High quality product with amazing features.',
      'Barely used, like new condition.',
      'Great value for money.',
      'Excellent condition, well maintained.',
    ];
    return this.pick(descriptions);
  },
};


