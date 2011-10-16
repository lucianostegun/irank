//
//  Event.m
//  iRank
//
//  Created by Luciano Stegun on 7/11/11.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import "Ranking.h"


@implementation Ranking

@synthesize rankingId;
@synthesize rankingName;
@synthesize players;
@synthesize events;

- (void) dealloc {
    
    [rankingName release];
    [players release];
    [events release];
    [super dealloc];
}

@end
