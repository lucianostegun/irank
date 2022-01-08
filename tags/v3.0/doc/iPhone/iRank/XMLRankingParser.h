//
//  XMLRankingParser.h
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright (c) 2011 __MyCompanyName__. All rights reserved.
//

#import <Foundation/Foundation.h>

@class Ranking;

@interface XMLRankingParser : NSObject <NSXMLParserDelegate> {
    
    NSMutableString *currentElementValue;
    
    Ranking *ranking;
    NSMutableArray *rankingList;
}

@property (nonatomic, copy) NSMutableArray *rankingList;
@property (nonatomic, retain) Ranking *ranking;

- (XMLRankingParser *) initXMLParser;
- (NSMutableArray *) getRankingList;
- (void) resetRankingList;
@end
