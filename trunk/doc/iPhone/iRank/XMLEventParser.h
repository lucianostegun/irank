//
//  XMLEventParser.h
//  iRank
//
//  Created by Luciano Stegun on 16/10/11.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>

@class Event;

@interface XMLEventParser : NSObject <NSXMLParserDelegate> {
    
    NSMutableString *currentElementValue;
    
    Event *event;
    NSMutableArray *eventList;
}

@property (nonatomic, copy) NSMutableArray *eventList;
@property (nonatomic, retain) Event *event;

- (XMLEventParser *) initXMLParser;
- (NSMutableArray *) getEventList;
- (void) resetEventList;
@end
