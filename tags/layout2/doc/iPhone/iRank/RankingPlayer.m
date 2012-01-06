//
//  RankingPlayer.m
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright (c) 2011 __MyCompanyName__. All rights reserved.
//

#import "RankingPlayer.h"

@implementation RankingPlayer
@synthesize rankingId;
@synthesize player;
@synthesize rankingPosition;
@synthesize totalEvents;
@synthesize totalScore;
@synthesize totalPaid;
@synthesize totalPrize;
@synthesize totalBalance;
@synthesize totalAverage;

- (void)dealloc {

    [player release];
    [super dealloc];
}

@end
