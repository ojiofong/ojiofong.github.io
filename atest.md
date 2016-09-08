---
layout: page
title: A test page
permalink: /atest
---
<!-- ---
layout: post
title:  "Building Android Apps for Multi Window support"
description: "A brief overview on how this site is hosted."
date:   2016-09-08 13:11:00
categories: [Tech]
tags: [android]
published: false
comments: true
--- -->
Android 7.0 (Nougat) allows two applications to run on one screen side by side at the same time. This feature is called the Split Screen Mode or Multi Window Mode. This awesome update enables users to multitask with ease and hence increasing productivity. However, for android  developers this means that it no longer business as usual, we now have to build android apps that provide a good user experience in Multi Window Mode. You can learn more about multi-window mode [here][multi_window]. This article focuses building multi-window aware apps for phones and tablets.


![Split Screen Diagram](/images/split-screen.png)
*This image was gotten from* [here][split_img_link]

### Overview
Multi window display is available in Android 7.0 (Nougat) only. In order to customize how your app responds to Multi Window display you must target at least API Level 24 (Android 7.0).

```java
defaultConfig {
      targetSdkVersion 24
      ...
  }
```


* Powered by a static site generator called [Jekyll][jekyll].
* The source for this website is [hosted on Github][alexmgraham_repo].
* The beautifully simplistic theme is [jekyll-uno by Josh Gerdes][jekyll-uno].
* [Github pages][github-pages] automatically compiles and serves the static HTML pages whenever a change is uploaded.

### Costs
* Github Pages: Free!
* SSL Certificate: Free!


[multi_window]. https://developer.android.com/guide/topics/ui/multi-window.html
[split_img_link]: https://developer.android.com/images/android-7.0/mw-splitscreen_2x.png
