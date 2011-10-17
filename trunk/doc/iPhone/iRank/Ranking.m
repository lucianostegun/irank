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
@synthesize rankingTypeId;
@synthesize gameStyleId;
@synthesize rankingName;
@synthesize players;
@synthesize events;
@synthesize rankingType;
@synthesize gameStyle;
@synthesize credit;
@synthesize startDate;
@synthesize finishDate;
@synthesize isPrivate;
@synthesize defaultBuyin;

- (void) dealloc {
    
    [rankingName release];
    [rankingType release];
    [gameStyle release];
    [credit release];
    [startDate release];
    [finishDate release];
    [isPrivate release];
    [defaultBuyin release];
    [players release];
    [events release];
    [super dealloc];
}

@end
