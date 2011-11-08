//
//  Player.m
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright (c) 2011 __MyCompanyName__. All rights reserved.
//

#import "Player.h"

@implementation Player
@synthesize playerId;
@synthesize firstName, lastName, emailAddress;

-(NSString *)fullName {
    
    return [NSString stringWithFormat:@"%@ %@", firstName, lastName];
}

-(NSString *)description {
    
    return [NSString stringWithFormat:@"%i: %@", playerId, [self fullName]];
}

-(void)dealloc {
    
    [firstName release];
    [lastName release];
    [emailAddress release];
}
@end
