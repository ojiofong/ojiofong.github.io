---
layout: post
title:  "Android Multi Window Support"
description: "Android 7.0 (Nougat) allows two applications to run on one screen side by side at the same time. This feature is called the Split Screen Mode or Multi Window Mode"
date:   2016-09-08 22:31:00
categories: [Tech]
tags: [android]
published: true
comments: true
regenerate: true
---

Android 7.0 (Nougat) allows two Activities/Applications to run on one screen side by side at the same time. This feature is called the Split Screen Mode or Multi Window Mode. This enables users to multitask with ease and hence increases productivity. However, for android developers this means that it is no longer business as usual, you have to develop android apps that provide a good user experience in Multi Window Mode.

This article focuses on developing multi-window aware apps for android phones and tablets. You can learn more about multi-window mode [here][multi_window].


![Split Screen Diagram](/images/split-screen.png)
*Image of an android phone in multi-window mode.* [Image source][split_img_link]

### Overview
Multi window display is available starting from Android 7.0 (Nougat) only. In order to customize how your app responds to Multi Window display you must target at least API Level 24 (Android 7.0).

```java
defaultConfig {
      targetSdkVersion 24
      ...
  }
```

The Android device determines how your app will be displayed in Multi Window display. Two apps can be displayed to fill one screen side by side or over another. The dimensions can also be adjusted by dragging on the dividing line between them. In addition to split-screen, larger devices can allow apps to be adjusted to any form if free form mode is enabled.

### Switching device to Multi Window

There are two ways that you can switch to split screen mode.

* To add another app/activity to the current foreground activity in multi-window mode, long press the [Overview or Recents][overview_screen] button. The device will enter into multi-window mode and open the Overview screen. You can then select an activity from the list of recent tasks to add to split-screen mode.
* You can also open the Overview or Recents Screen and long press on any recent task. You will then see an instruction on where to drag the task/activity in order to activate split screen mode.

### Activity Life Cycle in Multi-Window mode

In Multi-Window mode, it is possible for an Activity to be visible and not active. Only one Activity can be active at any given time, and that is the Activity most recently accessed. Any other visible Activity present on the screen remains in a paused state. The paused Activity is resumed only if the user interacts with it and consequentially the previously active Activity gets paused.

### Factors to consider

**Runtime Changes** - Just like an orientation change, switching in/out, or resizing an Activity in multi-window mode will trigger a configuration change that notifies the system that the dimensions have changed. As a result, you should anticipate and handle this behavior accordingly.

**Scrollable ViewGroup** - Because the dimensions of your Activity can increase or decrease, at the least ensure that your UI in nested in a Scrollable ViewGroup. This will allow users to access all UI component within your Activity.

**Video playback** - According to the [official][multi_window] documentation: "In multi-window mode, an app can be in the paused state and still be visible to the user. An app might need to continue its activities even while paused. For example, a video-playing app that is in paused mode but is visible should continue showing its video. For this reason, we recommend that activities that play video not pause the video in their ```onPause()``` handlers. Instead, they should pause video in ```onStop()```, and resume playback in ```onStart()```."


### Configuring your app

You must target at least API Level 24 to configure your android app for multi-window mode.

You can disable multi-window support by setting ```resizeableActivity``` attribute to ```false```. This can be set within the Activity or Application element in AndroidManifest.xml.

```java
android:resizeableActivity="false"
```
Unless explicitly specified, resizeableActivity attribute defaults to true If your targetSdkVersion is set to 24 or greater.

### Layout behavior in Multi-Window mode

A layout attribute included within the Activity element defines how the Activity will behave in multi-window and free-form mode. You can control the dimensions and position. For example:

```java
<activity android:name=".MyActivity">
    <layout android:defaultHeight="500dp"
          android:defaultWidth="600dp"
          android:gravity="top|end"
          android:minHeight="450dp"
          android:minWidth="300dp" />
</activity>
```

### Additional features

### Launching Activity in Multi-Window mode

It is possible to launch an Activity in Multi-Window mode displayed adjacent to the existing Activity. This is achieved by specifying the intent flag  ```FLAG_ACTIVITY_LAUNCH_ADJACENT```. If not in multi-window mode this flag will be ignored and the Activity will be launched in full screen mode.

Furthermore, if the Activity is in free-form mode you can choose to launch a new Activity in a specific location on the screen and with specific dimensions. You can do this by calling ```ActivityOptions.setLaunchBounds(Rect screenSpacePixelRect)```. Again, if not in free-form mode then this is ignored.


### Drag and Drop support

Multi-Window mode supports drag and drop between adjacent Activities/Apps. Prior to Android 7.0 we could only drag and drop within the same Activity. You may have to consider factoring this functionality into your app. You can learn more about [drag and drop][drag_drop] in the official documentation.

### References

For further reading please refer to the reference below.

Multi-Window support  
[https://developer.android.com/guide/topics/ui/multi-window.html][multi_window]




[multi_window]: https://developer.android.com/guide/topics/ui/multi-window.html
[split_img_link]: https://developer.android.com/images/android-7.0/mw-splitscreen_2x.png
[overview_screen]: https://developer.android.com/guide/components/recents.html
[drag_drop]: https://developer.android.com/guide/topics/ui/drag-drop.html
