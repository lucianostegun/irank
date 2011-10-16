//
//  XMLParser.h
//  iRank
//
//  Created by Luciano Stegun on 7/11/11.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>

@class iRankAppDelegate, Ranking;

@interface XMLParser : NSObject {
    
    NSMutableString *currentElementValue;
    
    iRankAppDelegate *appDelegate;
    Ranking *aRanking;
}

- (XMLParser *) initXMLParser;
@end
