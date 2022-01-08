//
//  EventPhoto.m
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright (c) 2011 __MyCompanyName__. All rights reserved.
//

#import "EventPhoto.h"

@implementation EventPhoto
@synthesize eventPhotoId, fileId;
@synthesize imageUrl, thumbUrl;

- (NSString *)description {
    
    return [NSString stringWithFormat:@"eventPhoto: %i: %@", eventPhotoId, imageUrl];
}

- (void)dealloc {
    
    [imageUrl release];
    [thumbUrl release];
}

@end
