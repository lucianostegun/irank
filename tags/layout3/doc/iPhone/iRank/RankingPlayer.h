//
//  RankingPlayer.h
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright (c) 2011 __MyCompanyName__. All rights reserved.
//

#import <Foundation/Foundation.h>
#import "Player.h"

@interface RankingPlayer : NSObject {
    
}

@property (nonatomic, readwrite) int rankingId;
@property (nonatomic, retain) Player *player;
@property (nonatomic, readwrite) int rankingPosition;
@property (nonatomic, readwrite) int totalEvents;
@property (nonatomic, readwrite) float totalScore;
@property (nonatomic, readwrite) float totalPaid;
@property (nonatomic, readwrite) float totalPrize;
@property (nonatomic, readwrite) float totalBalance;
@property (nonatomic, readwrite) float totalAverage;

@end
