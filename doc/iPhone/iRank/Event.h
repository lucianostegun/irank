//
//  EventClass.h
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import <Foundation/Foundation.h>

@interface Event : NSObject {
    
    int rankingPlaceId;
    BOOL sentEmail;
    int invites;
    int players;
    BOOL isFreeroll;
    float prizePot;
}

@property (nonatomic, readwrite) int eventId;
@property (nonatomic, readwrite) int rankingId;
@property (nonatomic, retain) NSString *eventName;
@property (nonatomic, retain) NSString *rankingName;
@property (nonatomic, retain) NSString *eventPlace;
@property (nonatomic, retain) NSString *eventDate;
@property (nonatomic, retain) NSString *startTime;
@property (nonatomic, retain) NSString *comments;
@property (nonatomic, retain) NSString *inviteStatus;
@property (nonatomic, retain) NSString *gameStyle;
@property (nonatomic, readwrite) float buyin;
@property (nonatomic, readwrite) float entranceFee;
@property (nonatomic, readwrite) int paidPlaces;
@property (nonatomic, readwrite) BOOL savedResult;
@property (nonatomic, readwrite) BOOL isMyEvent;
@property (nonatomic, readwrite) BOOL isPastDate;
@property (nonatomic, retain) NSMutableArray *eventPlayerList;

-(void)filterPlayerList;
-(float)totalBuyins;

-(void)saveResult:(id)sender;
@end
