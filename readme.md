# Image block for 🔥firekit
![image]({https://img.shields.io/badge/Composer-885630?style=for-the-badge&logo=Composer&logoColor=white})

> ⚠️ I created this plugin for my own use, so it might not be the best solution for your project. 

Part of the firekit pagebuilder system for KirbyCMS, see https://github.com/felixf/firekit-main, provides a custom image block with several features.

## Features

- lazyloading via unlazy.js
- automatic thumbnail generation via thumbhash
- aspect-ratio cropping with kirby focus point
- caption support (inside or outside of image)

## Installation

in your project root, run

`composer required felixf/fireblock-image`

## Usage

Add the block to your pagebuilder field in your blueprint:

```yaml
fieldsets:
  - image
```

## Todos

- [ ] load unlazy.js (currently done manually on project level)
- [ ] add github hook to update plugin on push
