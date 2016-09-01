---
layout: post
title:  "Introduction to Android Thread Pool and ThreadPoolExecutor"
date:   2016-08-29 21:30:00
categories: [Tech]
tags: [android]
description: "A brief overview on the small amount of infrastructure powering this site."
published: true
---
The knowledge of thread pools is required in advanced Android application development. If you want to build the fastest app possible then you need to leverage multi-threading. This is a simplified introduction to Thread Pools and ThreadPoolExecutor on Android. This article is also relevant to Java development.

### Topology
![ThreadPool Diagram](/images/thread-pool.png)

### Cloudfront with ACM
I am using a free Wildcard SSL certificate from Amazon Certificate Manager combined with [Cloudfront][cloudfront].
This might seem like a waste since Github pages are already [served from a CDN.][pages_cdn], but my main goal here was to use SSL on a custom domain.
Cloudfront is setup to respect all cache headers from Github (Currently 600s) so we should end up serving most requests from cache.

### Github Pages and Jekyll
* Powered by a static site generator called [Jekyll][jekyll].
* The source for this website is [hosted on Github][alexmgraham_repo].
* The beautifully simplistic theme is [jekyll-uno by Josh Gerdes][jekyll-uno].
* [Github pages][github-pages] automatically compiles and serves the static HTML pages whenever a change is uploaded.


### Costs
* Github Pages: Free!
* SSL Certificate: Free!
* Cloudfront: $0.085/GB (Data Usage TBD)

Overall I estimate that the costs should be pennies per month as I do not expect much traffic.

[cloudfront]:     https://aws.amazon.com/cloudfront/
[pages_cdn]:      https://github.com/blog/1715-faster-more-awesome-github-pages
[alexmgraham_repo]:      https://github.com/alexmgraham/alexmgraham.github.io
[jekyll-uno]: https://github.com/joshgerdes/jekyll-uno
[github-pages]: http://jekyllrb.com/docs/github-pages/
[jekyll]: http://jekyllrb.com/
