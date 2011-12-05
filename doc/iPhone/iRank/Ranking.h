//
//  Ranking.h
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright (c) 2011 __MyCompanyName__. All rights reserved.
//

#import <Foundation/Foundation.h>

@interface Ranking : NSObject <NSCoding> {
    
}

@property (nonatomic, readwrite) int rankingId;
@property (nonatomic, readwrite) int gameStyleId;
@property (nonatomic, readwrite) int players;
@property (nonatomic, readwrite) int events;
@property (nonatomic, readwrite) int rankingTypeId;
@property (nonatomic, retain) NSString *rankingName;
@property (nonatomic, readwrite) float credit;
@property (nonatomic, retain) NSString *gameStyle;
@property (nonatomic, retain) NSString *startDate;
@property (nonatomic, retain) NSString *finishDate;
@property (nonatomic, readwrite) BOOL isPrivate;
@property (nonatomic, retain) NSString *rankingType;
@property (nonatomic, readwrite) float defaultBuyin;
@property (nonatomic, readwrite) BOOL isMyRanking;
@property (nonatomic, retain) NSMutableArray *eventList;
@property (nonatomic, retain) NSMutableArray *rankingPlayerList;

- (id)initWithRankingId:(int)theRankingId;

- (void)loadArchivedRankingPlayerList;
- (void)loadPlayerList;
- (void)loadEventList;

- (void)addPlayer:(int)playerId firstName:(NSString *)firstName lastName:(NSString *)lastName emailAddress:(NSString *)emailAddress;

- (NSMutableArray*)sortedRankingPlayerList;

+ (NSString *)rankingArrayPath:(NSString *)sufix;
+ (NSMutableArray *)loadRankingList:(int)userSiteId;
+ (NSMutableArray *)loadArchivedRankingList:(NSString *)RankingType userSiteId:(int)userSiteId;
+ (void)removeCache;
@end
