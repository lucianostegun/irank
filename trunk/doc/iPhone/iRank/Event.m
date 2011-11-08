//
//  EventClass.m
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import "Event.h"

@implementation Event

@synthesize eventName, rankingName, eventPlace, eventDate, startTime;
@synthesize eventId;
@synthesize rankingId;
@synthesize comments;
@synthesize buyin;
@synthesize entranceFee;
@synthesize paidPlaces;
@synthesize savedResult;
@synthesize eventPlayerList;
@synthesize inviteStatus;

- (id)init {
    
    return self;
}

-(NSString *)eventName {
    
    return [eventName stringByTrimmingCharactersInSet: [NSCharacterSet whitespaceAndNewlineCharacterSet]];
}

-(NSString *)rankingName {
    
    return [rankingName stringByTrimmingCharactersInSet: [NSCharacterSet whitespaceAndNewlineCharacterSet]];
}

-(NSString *)eventPlace {
    
    return [eventPlace stringByTrimmingCharactersInSet: [NSCharacterSet whitespaceAndNewlineCharacterSet]];
}

-(NSString *)eventDate {
    
    return [eventDate stringByTrimmingCharactersInSet: [NSCharacterSet whitespaceAndNewlineCharacterSet]];
}

-(NSString *)startTime {
    
    return [startTime stringByTrimmingCharactersInSet: [NSCharacterSet whitespaceAndNewlineCharacterSet]];
}

-(NSString *)comments {
    
    return [comments stringByTrimmingCharactersInSet: [NSCharacterSet whitespaceAndNewlineCharacterSet]];
}

-(NSString *)inviteStatus {
    
    return [inviteStatus stringByTrimmingCharactersInSet: [NSCharacterSet whitespaceAndNewlineCharacterSet]];
}

- (NSString *)description {
    
    return [NSString stringWithFormat:@"%d: %@ @ %@", eventId, eventName, eventPlace];
}

- (void) dealloc {
    
    [eventName release];
    [rankingName release];
    [eventPlace release];
    [eventDate release];
    [startTime release];
    [comments release];
    [eventPlayerList release];
    [inviteStatus release];
    [super dealloc];
}

@end
