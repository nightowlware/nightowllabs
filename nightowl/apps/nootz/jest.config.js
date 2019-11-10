module.exports = {
  name: 'nootz',
  preset: '../../jest.config.js',
  coverageDirectory: '../../coverage/apps/nootz',
  snapshotSerializers: [
    'jest-preset-angular/AngularSnapshotSerializer.js',
    'jest-preset-angular/HTMLCommentSerializer.js'
  ]
};
