//
//  XMLRankingPlayerParser.h
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright (c) 2011 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "Player.h"

@class RankingPlayer;

@interface XMLRankingPlayerParser : NSObject <NSXMLParserDelegate> {
    
    NSMutableString *currentElementValue;
}

@property (nonatomic, retain) Player *player;
@property (nonatomic, retain) NSMutableArray *rankingPlayerList;
@property (nonatomic, retain) RankingPlayer *rankingPlayer;

- (XMLRankingPlayerParser *) initXMLParser;
- (NSMutableArray *) getRankingPlayerList;
- (void) resetRankingPlayerList;
@end
