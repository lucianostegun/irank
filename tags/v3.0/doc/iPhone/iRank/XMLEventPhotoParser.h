//
//  XMLEventPhotoParser.h
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright (c) 2011 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "EventPhoto.h"

@interface XMLEventPhotoParser : NSObject <NSXMLParserDelegate> {
    
    NSMutableString *currentElementValue;
    EventPhoto *eventPhoto;
}

@property (nonatomic, retain) NSMutableArray *eventPhotoList;

- (XMLEventPhotoParser *) initXMLParser;
- (NSMutableArray *) getEventPhotoList;
- (void) resetEventPhotoList;

@end
