---
layout: page
title: A test page
permalink: /atest
---
<!-- ---
layout: post
title:  "Building Android Apps for Multi Window support"
description: "Android 7.0 (Nougat) allows two applications to run on one screen side by side at the same time. This feature is called the Split Screen Mode or Multi Window Mode"
date:   2016-09-08 13:11:00
categories: [Tech]
tags: [android]
published: false
comments: true
--- -->
Android 7.0 (Nougat) allows two applications to run on one screen side by side at the same time. This feature is called the Split Screen Mode or Multi Window Mode. This awesome update enables users to multitask with ease and hence increases productivity. However, for android  developers this means that it no longer business as usual, we now have to build android apps that provide a good user experience in Multi Window Mode. You can learn more about multi-window mode [here][multi_window]. This article focuses on developing multi-window aware apps for android phones and tablets devices.


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

The Android device determines how your app will be displayed in Multi Window display.

* Two apps can be displayed to fill one screen side by side or over another. The apps' dimensions can also be adjusted by dragging on the dividing line between them.
* In addition to split-screen, larger devices can allow apps to be adjusted to any form if free form mode is enabled.

### Switching to Split Screen or Multi Window Mode

*Overview Screen* - Also called the Recents screen, Recents tasks, Recents apps. It shows a list of recently accessed activities or tasks.

*Overview Button* - Button that launches the Overview Screen.

There are two ways that you can switch to split screen mode.

* To add another app/activity to the current foreground activity in multi-window mode, long press the overview button. The device will enter into multi-window mode and open the overview screen so you can add an activity to split-screen mode.
* You can also open the Overview or Recents Screen and long press and long press on any activity. You will then see an instruction on where to drag the activity to activate split screen mode.

### Activity Life Cycle in Multi-Window mode

In Multi-Window mode, It is possible for an Activity to be visible and not active. Only one Activity can be active at any given time, and that is the Activity most recently accessed. Another visible Activity present in the screen remains in a paused state. The paused Activity is resumed only if the user interacts with it and consequentially the previously active Activity gets paused.

*Note* - According to the [official][multi_window] documentation."In multi-window mode, an app can be in the paused state and still be visible to the user. An app might need to continue its activities even while paused. For example, a video-playing app that is in paused mode but is visible should continue showing its video. For this reason, we recommend that activities that play video not pause the video in their onPause() handlers. Instead, they should pause video in onStop(), and resume playback in onStart()."

### Factors to consider

Runtime Changes - Just like an orientation change, switching into, out, or resizes an Activity in multi-window mode will trigger a configuration change that notifies the system that the dimensions have changed.

Scrollable ViewGroup - Because the dimensions of your Activity can shrink, at the least ensure that your UI in nested in a Scrollable ViewGroup. This will allow users to access all UI component within your Activity.

### Setting up  Multi-Window mode

You must target at least API Level 24 to configure your android app for multi-window mode.

You can disable multi-window support by setting resizeableActivity attribute to false. This can be set in the Activity or Application element.

```java
android:resizeableActivity="false"
```




[multi_window]. https://developer.android.com/guide/topics/ui/multi-window.html
[split_img_link]: https://developer.android.com/images/android-7.0/mw-splitscreen_2x.png
