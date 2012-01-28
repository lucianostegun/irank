//
//  EventClass.h
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import <Foundation/Foundation.h>

@interface Event : NSObject <NSCoding> {
    
    int rankingPlaceId;
    BOOL sentEmail;
    int invites;
    int players;
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
@property (nonatomic, readwrite) float rankingBuyin;
@property (nonatomic, readwrite) float entranceFee;
@property (nonatomic, readwrite) int paidPlaces;
@property (nonatomic, readwrite) BOOL savedResult;
@property (nonatomic, readwrite) BOOL isMyEvent;
@property (nonatomic, readwrite) BOOL isFreeroll;
@property (nonatomic, readwrite) BOOL isPastDate;
@property (nonatomic, readwrite) BOOL isEditable;
@property (nonatomic, readwrite) BOOL allowRebuy;
@property (nonatomic, readwrite) BOOL allowAddon;
@property (nonatomic, readwrite) BOOL hasOfflineResult;
@property (nonatomic, retain) NSMutableArray *eventPlayerList;
@property (nonatomic, retain) NSMutableArray *eventPlayerListFiltered;
//@property (nonatomic, readwrite) BOOL filteredPlayerList;

- (id)initWithEventId:(int)theEventId;

- (void)reloadPlayerList:(id)sender;// filter:(BOOL)filter;
- (NSMutableArray *)getFilteredPlayerList;
- (float)totalBuyin;
- (float)totalRebuy;
- (float)totalAddon;
- (float)totalBuyins:(BOOL)returnValue;

- (void)saveResult:(id)sender saveOffline:(BOOL)saveResultOffline;
- (void)loadArchivedEventPlayerList;

- (void)addPlayer:(int)playerId firstName:(NSString *)firstName lastName:(NSString *)lastName emailAddress:(NSString *)emailAddress;

+ (NSString *)eventArrayPath:(NSString *)sufix;
+ (NSMutableArray *)loadEventList:(NSString *)eventType userSiteId:(int)userSiteId limit:(int)limit;
+ (NSMutableArray *)loadEventList:(NSString *)eventType userSiteId:(int)userSiteId limit:(int)limit rankingId:(int)rankingId;
+ (NSMutableArray *)loadArchivedEventList:(NSString *)eventType userSiteId:(int)userSiteId limit:(int)limit;
+ (void)removeCache;
@end
