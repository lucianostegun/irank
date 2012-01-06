//
//  XMLEventPlayerParser.h
//  iRank
//
//  Created by Luciano Stegun on 16/10/11.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "Player.h"

@class EventPlayer;

@interface XMLEventPlayerParser : NSObject <NSXMLParserDelegate> {
    
    NSMutableString *currentElementValue;
}

@property (nonatomic, retain) Player *player;
@property (nonatomic, retain) NSMutableArray *eventPlayerList;
@property (nonatomic, retain) EventPlayer *eventPlayer;

- (XMLEventPlayerParser *) initXMLParser;
- (NSMutableArray *) getEventPlayerList;
- (void) resetEventPlayerList;
@end
