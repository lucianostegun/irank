//
//  XMLEventParser.h
//  iRank
//
//  Created by Luciano Stegun on 16/10/11.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>

@class iRankAppDelegate, Event;

@interface XMLEventParser : NSObject {
    
    NSMutableString *currentElementValue;
    
    iRankAppDelegate *appDelegate;
    Event *aEvent;
}

- (XMLEventParser *) initXMLParser;
@end
