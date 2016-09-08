---
layout: post
title:  "Introduction to Android Thread Pool and ThreadPoolExecutor"
date:   2016-08-29 21:30:00
categories: [Tech]
tags: [android]
description: "A simplified introduction to Thread Pools and ThreadPoolExecutor on Android"
published: true
comments: true
---


The knowledge of thread pool is required in advanced Android application development. If you want to build the fastest app possible then you need to leverage multi-threading. This is a simplified introduction to Thread Pools and ThreadPoolExecutor on Android. This article is also relevant to Java development.

*Note* — the code snippets in this article prioritize simplicity and readability over optimization. So, please let’s not nitpick about String concatenation or findViewById in a loop etc. However, any improvements related to the topic will be much appreciated.

In order to understand ThreadPoolExecutor, we must know what a thread pool is.

### What is a thread pool?

A thread pool is a collection of threads that can execute multiple instances of a task in parallel. Because tasks execute in parallel, you may want to ensure that your code is thread safe. A thread pool addresses two problems:

* Improved performance when executing large collection of asynchronous tasks due to a reduced per task overhead.
* A means of bounding and managing resources (including threads) when executing a collection of tasks.

### Illustration

Imagine that we want to do some work that involves performing 100 asynchronous tasks that will take 1 second each to process. If executed on a single thread, it will take 100 seconds to complete. Now if we did the same work using a thread pool of 10 threads; because each thread will execute 10 tasks each in parallel, it will now take only 10 seconds. Based on this example we have leveraged thread pools to achieve a reduced per task overhead that improved the time efficiency by 10 times or 1000%. Awesome! Isn’t it?

By now you’re probably thinking: “I get thread pools now, it makes sense to me. Now can we get to ThreadPoolExecutor?”. Sure. The good news is that you now have the base knowledge so let’s proceed.

**ThreadPoolExecutor** — Manages and assigns tasks to a thread pool or pool of threads. The way it works under the hood is that tasks to be run are kept in a work queue or a task queue. From the work queue, a task is assigned to a thread, whenever a thread in the pool becomes free or available. *Please refer to the image below for illustration.*

![ThreadPool Diagram](/images/thread-pool.png)
*This awesome image was gotten from* [here][pool_img_link]

### Why use ThreadPoolExecutor?

Threads by default do only three things; they start, do some work and terminate (if no work is being done). The process of keeping idle threads alive as implemented on Android Main Thread (UI Thread) is outside the scope of this topic, so I will keep it very simple; It requires pretending to be doing some work on the thread by running a message loop. Android achieves this by using a [Looper][looper_link].

Furthermore, when dealing with a collection of threads, it adds new layers of complexity since we will have to bound and manage resources and threads. Writing the code to handle all these may not be as fun as you think. It also increases the likelihood of running into bugs associated with multi-threaded environments.

ThreadPoolExecutor abstracts all of these, and allows us to easily manage and assign tasks to a pool of threads. It even takes care of terminating the threads for us appropriately.

Here are some related terminologies to know.

**Runnable** — A command or task that can be executed. Often used to run code in a different thread. e.g.

```java
Runnable mRunnable = new Runnable() {
    @Override
    public void run() {
        // Do some work
    }
};
```

**Executor** — An object that executes runnable. e.g.

```java
Executor mExecutor = Executors.newSingleThreadExecutor();
mExecutor.execute(mRunnable);
```

**ExecutorService** — An Executor that manages asynchronous tasks. e.g.

```java
ExecutorService mExecutorService = Executors.newFixedThreadPool(10);
mExecutorService.execute(mRunnable);
```


**ThreadPoolExecutor** — An ExecutorService that assigns tasks to a pool of threads. An instance can be created by providing the arguments to the constructor below.

```java
ThreadPoolExecutor(
   int corePoolSize,    // Initial pool size
   int maximumPoolSize, // Max pool size
   long keepAliveTime,  // Time idle thread waits before terminating
   TimeUnit unit        // Sets the Time Unit for keepAliveTime
   BlockingQueue<Runnable> workQueue)  // Work Queue
```

### ThreadPoolExecutor Example

This example shows how to use ThreadPoolExecutor to perform 100 asynchronous tasks. The snippets below contain an Activity class and a Layout file that illustrate a simple android app that will help us visually compare thread pool performance against a single thread’s performance.
In order to see the performance difference, you will have to build and run the code.

Feel free to include the full snippets in your android project.

<!-- Styling all gist snippet on this file-->
<style type="text/css">
  .gist {overflow:auto !important;}
  .gist-file
  .gist-data {max-height: 600px; max-width: auto;}
</style>

<script src="https://gist.github.com/ojiofong/4b8bd2edce4644fa734634caaab3d222.js"></script>

The Activity class is accompanied by a simple layout. It is optional to include it here, but for the sake of convenience I will include it below.

<script src="https://gist.github.com/ojiofong/1ee09c2759b5ff93993f6eef12ce8e2c.js"></script>


### More threads are not always good

More threads are not always good because CPU can only execute a certain number of threads in parallel. Once we exceed that number, CPU has to make some expensive calculation to decide which thread should get assigned based on priority. Depending on the number of excess unnecessary threads, your program can hit a break-even point where it is not any faster, if not slower. In addition, threads are associated with a minimum memory overhead of 64k that can add up quickly.

It is usually recommended to allocate threads based on the number of available cores. This is achieved in Java via:

```java
int NUMBER_OF_CORES = Runtime.getRuntime().availableProcessors();
```

*Note* — this does not necessarily return the actual number of physical cores on the device. It is possible that CPU may deactivate some cores to save battery etc.

### Conclusion
We have learned a bit about threads, what thread pools are, why we need it and how to use it. We now know that we use ThreadPoolExecutor to conveniently manage and assign tasks to a pool of threads. We have also looked at a program that illustrates a simple usage of ThreadPoolExecutor.

In summary, ThreadPoolExecutor allows us to create a number of threads and assign a number of work to be done. It takes care of handling load balancing of work across the threads, and also the termination of threads that are no longer needed.

There are a lot more to know, but we have managed to learn a lot while keeping things simple. Hopefully, we are now able to jump right in and start using thread pools to build more efficient Android applications.

For further reading please refer to the references below.

### References:

Creating a Manager for Multiple Threads | Android Developers
[https://developer.android.com/training/multiple-threads/create-threadpool.html][1]

ThreadPoolExecutor (Java Platform SE 7 )
[https://docs.oracle.com/javase/7/docs/api/java/util/concurrent/ThreadPoolExecutor.html][2]

Swimming in Threadpools. (Android Performance Patterns Season 5, Ep. 6)
[https://www.youtube.com/watch?v=uCmHoEY1iTM][3]

[1]: https://developer.android.com/training/multiple-threads/create-threadpool.html
[2]: https://docs.oracle.com/javase/7/docs/api/java/util/concurrent/ThreadPoolExecutor.html
[3]: https://www.youtube.com/watch?v=uCmHoEY1iTM
[looper_link]: https://developer.android.com/reference/android/os/Looper.html
[pool_img_link]: http://allegro.tech/img/articles/2015-04-22-thread-pools/thread-pool.png
