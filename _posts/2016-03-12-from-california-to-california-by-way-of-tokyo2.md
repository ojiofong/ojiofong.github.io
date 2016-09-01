---
layout: page
title:  "From California to California by way of Tokyo2"
date:   2016-03-12 01:00:00
categories: [Tech]
tags: [infrastructure]
description: "The story of a confused request who made it's way from California to Tokyo only to be sent right back to California."
published: true
---
The story of a confused request who made it's way from California to Tokyo only to be sent right back to California.

## Here's the problem...

When using one of the Level3 Public DNS resolvers in San Francisco, CA Cloudfront routes the request to an edge node in Tokyo. This means that the request is traveling across the ocean only to come back to the origin server in Northern California (us-west-2 region). This is obviously not an ideal situation and it must be a problem with Cloudfront right!? Wrong... The cause of this issue is actually even more complex than it seems.

## Lets dig in...
We start by configuring a Cloudfront distribution with all Edge locations enabled.

Now lets spin up an EC2 instance in Northern California (us-west-2). We can also just use any ISP in the bay area.

```bash
ubuntu@ip-172-31-14-87:~$ curl -s http://169.254.169.254/latest/meta-data/placement/availability-zone
us-west-1c
```

I patched together a few commands to accomplish the following:
1. Check the A records associated with our Cloudfront distribution.
2. For each of those A records check the PTR record associated with each IP.
3. Cloudfront uses an airport code in the naming scheme for the edge node hostnames. This will allow us to easily determine the location.
