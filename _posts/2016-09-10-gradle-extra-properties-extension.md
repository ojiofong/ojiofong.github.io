---
layout: post
title:  "Using Gradle Extra Properties Extension to manage Android dependencies version"
description: "Gradle is a flexible and advanced build system. Using Gradle Extra property we can conveniently manage Android dependencies, SDK and buildTools version"
date:   2016-09-10 12:30:00 AM
categories: [Tech]
tags: [android, gradle]
published: true
comments: true
regenerate: true
---

Gradle is an advanced build system. Android Studio adopted gradle due to its flexibility, good tooling API, dependency management through Maven etc. The language used by Gradle is [Groovy][groovy_site]. A gradle project has a ```build.gradle``` file in the root of the project directory. This gradle file describes the build configuration for the project.

This article is about using gradle [Extra Properties Extension][extra_properties_extension] to manage dependency versions and configurations, conveniently across the entire project.


### Problem

Whenever there's a version update to a library or build tools version in your build.gradle file, most developers are daunted by the repetitive task of manually inputting the new version for every library dependency. For e.g. if android support libraries version changes then you will have update the versions everywhere.

A basic build.gradle file within the app module would similar to this:

```java
apply plugin: 'com.android.application'

android {
    compileSdkVersion 24
    buildToolsVersion "24.0.1"

    defaultConfig {
        minSdkVersion 21
        targetSdkVersion 24
        ...
    }

dependencies {
    ...
    compile 'com.android.support:appcompat-v7:24.1.1'
    compile 'com.android.support:appcompat-v4:24.1.1'
    compile 'com.android.support:recyclerview-v7:24.1.1'
    compile 'com.android.support:design:24.1.1'
    compile 'com.google.android.gms:play-services:9.4.0'
}
```

From the snippet above, we have four repeated versions ```24.1.1``` from com.android.support library dependencies alone. It gets worse and compounds easily if you have multiple modules within your project. However, there is a solution.

### Solution

**Externalize hardcoded values** in the root project module ```build.gradle``` file. (Not in the app module or any sub module). This allows you to access values from any module within your project.

```java
// Top-level build file where you can add configuration options common to all sub-projects/modules.

ext {
    compileSdkVersion = 24
    buildToolsVersion = '24.0.1'
    minSdkVersion = 21
    targetSdkVersion = 24
    supportLibraryVersion = '24.2.0'
    playServicesVersion = '9.4.0'
}
```

After you've externalized the hardcoded values in the root project directory, other sub-modules within the project can now access the values, hence making version updates a breeze. Below is a sample snippet of the app module's ```build.gradle``` file that shows how to conveniently access the hardcoded values.

```java
apply plugin: 'com.android.application'

android {
    compileSdkVersion rootProject.compileSdkVersion
    buildToolsVersion rootProject.buildToolsVersion

    defaultConfig {
        minSdkVersion rootProject.minSdkVersion
        targetSdkVersion rootProject.targetSdkVersion
        ...
    }

dependencies {
    ...
    // support libraries
    compile "com.android.support:appcompat-v7:$rootProject.supportLibraryVersion"
    compile "com.android.support:support-v4:$rootProject.supportLibraryVersion"
    compile "com.android.support:recyclerview-v7:$rootProject.supportLibraryVersion"
    compile "com.android.support:design:$rootProject.supportLibraryVersion"

    // play services
    compile "com.google.android.gms:play-services:$rootProject.playServicesVersion"
}
```

### Important

Note the use of *double quotation* within dependencies (instead of single quotation).

We changed from single quoted strings e.g.

```java
compile 'com.android.support:appcompat-v7:24.1.1'
```

to double quoted strings e.g.

```java
compile "com.android.support:appcompat-v7:$rootProject.supportLibraryVersion"
```

Also note the use of ```$```, which is simply the symbol for [string interpolation][groovy_interpolation] in Groovy.

We cannot use single quotation here because the [official documentation][groovy_interpolation] clearly states that any Groovy expression can be interpolated in all string literals, apart from single and triple single quoted strings.

For further reading, please refer to the references below.

### References

Gradle Plugin User Guide  
[http://tools.android.com/tech-docs/new-build-system/user-guide][gradle_guide]  

Groovy Language Documentation  
[http://docs.groovy-lang.org/latest/html/documentation/index.html][groovy_doc]







[gradle_guide]: http://tools.android.com/tech-docs/new-build-system/user-guide
[groovy_interpolation]: http://docs.groovy-lang.org/latest/html/documentation/index.html#_string_interpolation
[groovy_doc]: http://docs.groovy-lang.org/latest/html/documentation/index.html
[groovy_site]: http://groovy-lang.org/
[extra_properties_extension]: https://docs.gradle.org/current/dsl/org.gradle.api.plugins.ExtraPropertiesExtension.html
