//
//  EventPlayer.h
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright (c) 2011 __MyCompanyName__. All rights reserved.
//

#import <Foundation/Foundation.h>
#import "Player.h"
@interface EventPlayer : NSObject {
    
    
}

@property (nonatomic, retain) Player *player;
@property (nonatomic, readwrite) BOOL enabled;
@property (nonatomic, readwrite) int eventId;
@property (nonatomic, retain) NSString *inviteStatus;
@property (nonatomic, readwrite) int eventPosition;
@property (nonatomic, readwrite) float buyin;
@property (nonatomic, readwrite) float rebuy;
@property (nonatomic, readwrite) float addon;
@property (nonatomic, readwrite) float prize;
@property (nonatomic, readwrite) float score;

-(void)togglePresence:(NSString *)choice;

@end
