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

- (void)encodeWithCoder:(NSCoder *)encoder {
    
    [encoder encodeInt:playerId forKey:@"playerId"];
    [encoder encodeObject:firstName forKey:@"firstName"];
    [encoder encodeObject:lastName forKey:@"lastName"];
    [encoder encodeObject:emailAddress forKey:@"emailAddress"];
}

- (id)initWithCoder:(NSCoder *)decoder {
    
    [super init];
    
    [self setPlayerId: [decoder decodeIntForKey:@"playerId"]];
    [self setFirstName: [decoder decodeObjectForKey:@"firstName"]];
    [self setLastName: [decoder decodeObjectForKey:@"lastName"]];
    [self setEmailAddress: [decoder decodeObjectForKey:@"emailAddress"]];
    
    return self;
}

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
