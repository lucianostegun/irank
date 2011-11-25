//
//  ImageCache.m
//  Homepwner
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import "ImageCache.h"
#import "FileHelpers.h"

static ImageCache *sharedImageCache;

@implementation ImageCache

- (id)init
{
    self = [super init];

    dictionary = [[NSMutableDictionary alloc] init];
    
    return self;
}

#pragma mark Accessing the cache

-(void)setImage:(UIImage *)image forKey:(NSString *)key {
    
    [dictionary setObject:image forKey:key];
    
    // Create full path for image
    NSString *imagePath = pathInDocumentDirectory(key);
    
    NSLog(@"imagePath: %@", imagePath);
    
    // Turn image into JPEG data
    NSData *d = UIImageJPEGRepresentation(image, 0.5);
    
    // Write it to full path
    [d writeToFile:imagePath atomically:YES];
}

-(UIImage *)imageForKey:(NSString *)s {
    
    
    // If possible, get it from the dictionary
    UIImage *result = [dictionary objectForKey:s];
    
    if( !result ){
        
        // Create UIImage object from file
        result = [UIImage imageWithContentsOfFile:pathInDocumentDirectory(s)];
        
        // If we found an image on the file system, place it into the cache
        if( result )
            [dictionary setObject:result forKey:s];
        else
            NSLog(@"Error: unable to find %@", pathInDocumentDirectory(s));
    }
    
    return [dictionary objectForKey:s];
}


// Aqui, "s" na vdd deveria se chamar "key", mas eu so estava seguindo o livro.
-(void)deleteImageForKey:(NSString *)s {
    
    [dictionary removeObjectForKey:s];
    
//    NSString *path = pathInDocumentDiretory(s);
//    [[NSFileManager defaultManager] removeItemAtPath:path error:nil];
}

#pragma mark Singleton stuff
// Singleton é um tipo de objeto que só pode ser instanciado uma vez dentro da aplicação, assim como o UIAccelerometer

+(ImageCache *)sharedImageCache {
    
    if( !sharedImageCache )
        sharedImageCache = [[ImageCache alloc] init];
    
    return sharedImageCache;
}

+(id)allocWithZone:(NSZone *)zone {
    
    if( !sharedImageCache ){
        
        sharedImageCache = [super allocWithZone:zone];
        return sharedImageCache;
    }else{
        
        return nil;
    }
}

-(id)copyWithZone:(NSZone *)zone {
    
    return self;
}

-(void)release {
    
    // No op
}

@end
