//
//  Event.m
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import "Event.h"

@implementation Event

@synthesize eventId;
@synthesize rankingId;
@synthesize rankingName;
@synthesize eventName;
@synthesize eventDate;
@synthesize startTime;

- (void) dealloc {
    
    [eventName release];
    [rankingName release];
    [eventDate release];
    [startTime release];
    [super dealloc];
}

@end
