//
//  XMLRankingParser.h
//  iRank
//
//  Created by Luciano Stegun on 7/11/11.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>

@class iRankAppDelegate, Ranking;

@interface XMLRankingParser : NSObject {
    
    NSMutableString *currentElementValue;
    
    iRankAppDelegate *appDelegate;
    Ranking *aRanking;
}

- (XMLRankingParser *) initXMLParser;
@end
